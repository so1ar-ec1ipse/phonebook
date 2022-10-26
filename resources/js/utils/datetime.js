import dayjs from 'dayjs';
import customParseFormat from 'dayjs/plugin/customParseFormat';
import utc from 'dayjs/plugin/utc';

dayjs.extend(customParseFormat)
dayjs.extend(utc)

/**
 * 
 * @param {string} isoDate
 * 
 * @return {string} formatted date string
 */

export const convertISOFormat2Date = function (isoDate) {
    return dayjs(isoDate).format('MM/DD/YY hh:mm a');
}
