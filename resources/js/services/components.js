import OpeningHoursIndex from '../components/admin/agenda/opening-hours/Index.svelte';
import ShowOpeningHours from '../components/admin/agenda/opening-hours/Show.svelte'
import CreateOpeningHours from '../components/admin/agenda/opening-hours/Create.svelte';
import ConfigurationIndex from '../components/admin/agenda/configurations/Index.svelte';
import AppointmentsCreate from '../components/admin/appointments/Create.svelte';
import AvailableTime from '../components/admin/appointments/AvailableTime.svelte';
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
        name: 'AppointmentsCreate',
        component: AppointmentsCreate
    },
    {
        name: 'AvailableTime',
        component: AvailableTime
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