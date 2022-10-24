<script>
    import Calendar from "../components/admin/agenda/calendar.svelte";
import CalendarActions from "../components/admin/agenda/calendar_actions.svelte";
    import Main from "../components/admin/layout/Main.svelte";
</script>

<svelte:head>
    <title>Agenda</title>
</svelte:head>

<Main>
    <div slot="title">Agenda</div>
    <Calendar></Calendar>
</Main>
