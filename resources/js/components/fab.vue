<template>
    <div id="fab">
        <!--Example dependecies-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <fab
            :position="position"
            :icon-size="iconSizes"
            :position-type="positionType"
            :bg-color="colors.rgba"
            :main-icon="mainIcon"
            :main-tooltip="mainTooltip"
            :actions="[
                {name: 'ot', icon: firstIcon, tooltip: firstTooltip, color:'rgba(59, 89, 152, 0.8)'},
                {name: 'facctura', icon: secondIcon, tooltip: secondTooltip, color:'rgba(59, 89, 152, 0.8)'},
                {name: 'libro', icon: thirdIcon, tooltip: thirdTooltip, color:'rgba(59, 89, 152, 0.8)'}
            ]"
            @alertMe="alert"
            :fixed-tooltip="fixedTooltip"
            :enable-rotation="enableRotation"
        ></fab>
    </div>
</template>

<script>
    import FAB from 'vue-fab';
    import {Chrome} from 'vue-color';
    const defaultProps = {
        rgba: 'rgba(59, 89, 152, 1)',
    };
    export default {
        name: 'app',
        components: {
            fab: FAB,
            'chrome-picker': Chrome
        },
        data(){
            return {
                positions: [
                    'bottom-right',
                    'bottom-left',
                    'top-right',
                    'top-left',
                ],
                positionTypes: [
                    'fixed',
                    'absolute'
                ],
                tooltipEvents: [
                    'hover',
                    'fixed'
                ],
                sizes: [
                    'small',
                    'medium',
                    'large'
                ],
                //component init
                position: 'bottom-right',
                positionType: 'fixed',
                tooltipEvent: 'hover',
                iconSizes: 'medium',
                colors: defaultProps,
                //main elem
                mainIcon: 'add',
                mainTooltip: 'Agregado rápido',
                //first elem
                firstIcon: 'build',
                firstTooltip: 'Nueva Ot',
                //second elem
                secondIcon: 'show_chart',
                secondTooltip: 'Nueva factura',
                //third elem
                thirdIcon: 'menu_book',
                thirdTooltip: 'Nueva entrada',
                enableRotation: true
            }
        },
        computed: {
            fixedTooltip() {
                return this.tooltipEvent === 'fixed';
            }
        },
        methods: {
            alert(){
                alert('You have clicked me :)');
            }
        }
    }
</script>