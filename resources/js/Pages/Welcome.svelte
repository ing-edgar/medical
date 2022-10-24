<script>
    import Main from "../components/admin/layout/Main.svelte";
    export let title;
</script>

<Main>
    <div slot="title">Dashboard</div>
    <h1 class="text-red-600">Hola mundo {title}</h1>
</Main>
