<script>
    import Fa from "svelte-fa/src/fa.svelte";
    import { onMount } from "svelte";
    import { createPopper } from "@popperjs/core";
    export let icon, name, ref;

    let reference, tooltip, arrow;
    let show = false;

    function onFocus() {
        console.log("onFOcus");
        show = true;
    }

    function onBlur() {
        show = false;
    }

    onMount(() => {
        createPopper(reference, tooltip, {
            placement: "right",
            modifiers: [
                {
                    name: "offset",
                    options: {
                        offset: [-10, 20],
                    },
                },
                {
                    name: "arrow",
                    options: {
                        element: arrow,
                    },
                },
            ],
        });
    });

    function isActive() {
        if (ref) {
            return window.location.href.includes(route(ref));
        }
    }

    function getUrl() {
        return ref ? route(ref) : "#";
    }
</script>

<!-- svelte-ignore a11y-mouse-events-have-key-events -->
<div class="w-full px-1">
    <div
        class:active={isActive()}
        class="w-full flex items-center justify-center"
    >
        <a
            href={getUrl()}
            class="relative h-8 w-8 flex justify-center items-center"
            on:mouseover={onFocus}
            on:mouseout={onBlur}
            bind:this={reference}
        >
            <Fa {icon} class="text-xl" />
        </a>
        <span
            class:hidden={!show}
            class="bg-gray-700 px-2 rounded-md"
            bind:this={tooltip}
        >
            {name}
            <div id="arrow" data-popper-arrow bind:this={arrow} />
        </span>
    </div>
</div>

<style>
    #arrow,
    #arrow::before {
        position: absolute;
        width: 8px;
        height: 8px;
        background: inherit;
        margin-top: 4px;
        margin-left: -5px;
    }

    #arrow {
        visibility: hidden;
    }

    #arrow::before {
        visibility: visible;
        content: "";
        transform: rotate(45deg);
    }
    .active {
        @apply border-l-4 border-white;
    }
</style>
