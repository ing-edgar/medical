import OpeningHoursIndex from '../components/admin/agenda/opening-hours/Index.svelte';
import ShowOpeningHours from '../components/admin/agenda/opening-hours/Show.svelte'
import CreateOpeningHours from '../components/admin/agenda/opening-hours/Create.svelte';
//import ConfigurationForm from '$lib/components/agenda/configuration/form.svelte';

export const components = [
    {
        name: 'OpeningHoursIndex',
        component: OpeningHoursIndex
    },
    {
        name: 'ShowOpeningHours',
        component: ShowOpeningHours
    },
    {
        name: 'CreateOpeningHours',
        component: CreateOpeningHours
    },
    {
        name: 'ConfigurationForm',
        //component: ConfigurationForm
    },
    {
        name: 'OfficeHourEventForm',
        //component: OfficeHourEventForm
    },
    {
        name: 'AppointmentsBase',
        //component: AppointmentsBase
    },
    {
        name: 'AppointmentsIndex',
        //component: AppointmentsIndex
    },
    {
        name: 'AppointmentsAvailable',
        //component: AppointmentsAvailable
    }
]