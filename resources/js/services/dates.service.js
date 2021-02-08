
import { DateTime } from "luxon";
export function formatDate(date) {
    return date && DateTime.fromISO(date).toFormat("yyyy LLL dd");
}