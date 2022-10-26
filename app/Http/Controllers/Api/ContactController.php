<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Models\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ContactController extends Controller
{
    public function index()
    {
        return ContactResource::collection(Contact::all());
    }

    public function search(Request $request)
    {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $middle_name = $request->input('middle_name');
        $email = $request->input('email');
        $title = $request->input('title');
        $number = $request->input('number');

        $query = Contact::query();
        if ($first_name) $query->where('first_name', 'like', '%' . $first_name . '%');
        if ($last_name) $query->where('last_name', 'like', '%' . $last_name . '%');
        if ($middle_name) $query->where('middle_name', 'like', '%' . $middle_name . '%');
        if ($email) $query->where('email', 'like', '%' . $email . '%');
        if ($title) $query->where('title', 'like', '%' . $title . '%');
        if ($number) $query->whereHas('phoneNumbers', function (Builder $query) use($number) {
            $query->where('number', 'like', '%' . $number . '%');
        });

        $searchedContacts = $query->orderBy('contacts.created_at', 'desc')->get();

        return ContactResource::collection($searchedContacts);
    }

    public function store(StoreContactRequest $request)
    {
        $data = $request->validated();
        $contact = Contact::create($data);
        $phoneNumber = new PhoneNumber($data['default_phone_number']);

        $contact->phoneNumbers()->save($phoneNumber);

        return new ContactResource($contact);
    }

    public function show(Contact $contact)
    {
        return new ContactResource($contact);
    }

    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $data = $request->validated();
        $contact->update($data);
        $contact_id = $contact->id;
        $phoneNumbers = $data['phone_numbers'];

        $originalPhoneNumberIds = [];
        foreach ($contact->phoneNumbers as $phoneNumber) {
            array_push($originalPhoneNumberIds, $phoneNumber['id']);
        }
        $insertedPhoneNumberIds = [];
        foreach ($phoneNumbers as $phoneNumber) {
            array_push($insertedPhoneNumberIds, $phoneNumber['number']);
        }

        $phoneNumbersWithContactId = [];
        foreach ($phoneNumbers as $phoneNumber) {
            array_push($phoneNumbersWithContactId, [...$phoneNumber, 'contact_id' => $contact_id]);
        }
        
        $contact->phoneNumbers()->upsert($phoneNumbersWithContactId, ['id'], ['number', 'phone_type', 'is_default', 'contact_id']);
        
        
        
        $phoneNumberIdsToRemove = array_diff($originalPhoneNumberIds, $insertedPhoneNumberIds);
        
        // PhoneNumber::destroy($phoneNumberIdsToRemove);
        var_dump($data);

        return new ContactResource($contact);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->noContent();
    }
}
