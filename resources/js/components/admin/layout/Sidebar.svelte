<script>
    import Fa from "svelte-fa/src/fa.svelte";
    import ItemMenu from "./ItemMenu.svelte";
    import {
        faBell,
        faCalendarDays,
        faCalendarCheck,
        faUsers,
        faNewspaper,
        faRightFromBracket,
        faUser,
        faStaffSnake,
    } from "@fortawesome/free-solid-svg-icons";
</script>

<div
    class="flex flex-col justify-between items-center flex-none w-16
    bg-sky-700 text-white"
>
    <div class="flex flex-col space-y-4 w-full items-center pt-5">
        <a
            href={"#"}
            class="relative h-8 w-8 flex justify-center items-center mb-4"
            ><Fa icon={faStaffSnake} class="text-2xl" /></a
        >

        <a href={"#"} class="relative h-8 w-8 flex justify-center items-center">
            <Fa icon={faBell} class="text-xl" />
            <div
                class="absolute top-0 right-0 mr-0 mt-0 bg-red-500 w-4 h-4
                text-xs text-white rounded-full text-center"
            >
                5
            </div>
        </a>
        <ItemMenu icon={faCalendarCheck} name="Agenda" ref="agenda.index" />
        <ItemMenu icon={faCalendarDays} name="Citas" ref="appointments.index" />
        <ItemMenu icon={faUsers} name="Usuarios" />
        <ItemMenu icon={faNewspaper} name="Artículos" />
    </div>
    <div class="flex flex-col space-y-4 pb-5">
        <ItemMenu icon={faUser} name="Perfil" />
        <ItemMenu icon={faRightFromBracket} name="Cerrar sesión" />
    </div>
</div>
