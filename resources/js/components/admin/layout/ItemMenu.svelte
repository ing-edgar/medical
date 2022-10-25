<script>
    import Fa from "svelte-fa/src/fa.svelte";
    import { onMount } from "svelte";
    import { createPopper } from "@popperjs/core";
    export let icon, name;

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
</script>

<!-- svelte-ignore a11y-mouse-events-have-key-events -->
<a
    href={"#"}
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
    <div id="arrow" data-popper-arrow bind:this={arrow}/>
</span>

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
</style>
