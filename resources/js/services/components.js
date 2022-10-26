import OpeningHoursIndex from '../components/admin/agenda/opening-hours/Index.svelte';
import ShowOpeningHours from '../components/admin/agenda/opening-hours/Show.svelte'
import CreateOpeningHours from '../components/admin/agenda/opening-hours/Create.svelte';
import ConfigurationIndex from '../components/admin/agenda/configurations/Index.svelte';
import Select from '../components/admin/layout/Select.svelte';

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
        name: 'ConfigurationIndex',
        component: ConfigurationIndex
    },
    {
        name: 'Select',
        component: Select
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