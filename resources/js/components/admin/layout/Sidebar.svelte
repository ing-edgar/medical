<script>
import Fa from "svelte-fa/src/fa.svelte";
import {
    faBell,
    faCalendarDays,
    faCalendarCheck,
    faUsers,
    faNewspaper,
    faRightFromBracket,
    faUser,
    faStaffSnake
} from "@fortawesome/free-solid-svg-icons";
</script>

<div class="flex flex-col justify-between items-center flex-none w-16
    bg-sky-700 text-white">
    <div class="flex flex-col space-y-4 w-full items-center pt-5">
        <a href="{'#'}" class="relative h-8 w-8 flex justify-center items-center mb-4"><Fa icon={faStaffSnake} class="text-2xl"></Fa></a>

        <a href="{'#'}" class="relative h-8 w-8 flex justify-center items-center">
            <Fa icon={faBell} class="text-xl"></Fa>
            <div class="absolute top-0 right-0 mr-0 mt-0 bg-red-500 w-4 h-4
                text-xs text-white rounded-full text-center">
                5
            </div>
        </a>
        <a href="{'#'}" class="relative h-8 w-8 flex justify-center items-center"><Fa icon={faCalendarDays} class="text-xl"></Fa></a>
        <a href="{'#'}" class="relative h-8 w-8 flex justify-center items-center"><Fa icon={faCalendarCheck} class="text-xl"></Fa></a>
        <a href="{'#'}" class="relative h-8 w-8 flex justify-center items-center"><Fa icon={faUsers} class="text-xl"></Fa></a>
        <a href="{'#'}" class="relative h-8 w-8 flex justify-center items-center"><Fa icon={faNewspaper} class="text-xl"></Fa></a>
    </div>
    <div class="flex flex-col space-y-4 pb-5">
        <a href="{'#'}" class="relative h-8 w-8 flex justify-center items-center"><Fa icon={faUser} class="text-xl"></Fa></a>
        <a href="{'#'}" class="relative h-8 w-8 flex justify-center items-center"><Fa icon={faRightFromBracket} class="text-xl"></Fa></a>
    </div>
</div>
