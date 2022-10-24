export function buildDays(month, today) {
    let start_day = month.clone().startOf('month').startOf('week').day(0);
    const end_day = month.clone().endOf('month').endOf('week').day(6);

    let days = [];
    let calendar;

    while (start_day < end_day) {
        const day = {
            isValid: start_day.isSameOrAfter(today, 'date'),
            date: start_day.format('YYYY-MM-DD'),
            number: start_day.format('D'),
            isToday: today.isSame(start_day, 'date'),
        }
        days.push(day);
        start_day = start_day.clone().add(1, 'd');
    }
    calendar = {
        month_name: month.format('MMMM'),
        year: month.format('YYYY'),
        days
    }
    return calendar;
}