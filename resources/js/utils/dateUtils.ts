import { format, parseISO, formatRelative, subDays } from 'date-fns';
import { es } from "date-fns/locale";

export const formatDate = (date: string | Date, dateFormat = 'dd/MM/yyyy') => {
  if(!date) return;
  const parsedDate = typeof date === 'string' ? parseISO(date) : date;
  return format(parsedDate, dateFormat, {locale:es});
};

export const formatDateWithHour = (date: string | Date, dateFormat = 'PPpp') => {
  const parsedDate = typeof date === 'string' ? parseISO(date) : date;
  return format(parsedDate, dateFormat, {locale:es});
};

export const formatRelativeTime = (date: string | Date) => {
  const parsedDate = typeof date === 'string' ? parseISO(date) : date;
  return formatRelative(date, new Date(), {locale:es})
};
