<script>
    import Main from "../components/admin/layout/Main.svelte";
    export let title;
</script>

<svelte:head>
    <title>Welcome</title>
</svelte:head>

<Main>
    <div slot="title">Dashboard</div>
    <h1 class="text-red-600">Página en construcción</h1>
</Main>
