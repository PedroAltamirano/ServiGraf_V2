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
                {name: 'pedido', icon: firstIcon, tooltip: firstTooltip, color:'rgba(59, 89, 152, 0.8)'},
                {name: 'factura', icon: secondIcon, tooltip: secondTooltip, color:'rgba(59, 89, 152, 0.8)'},
                {name: 'entrada', icon: thirdIcon, tooltip: thirdTooltip, color:'rgba(59, 89, 152, 0.8)'}
            ]"
            :fixed-tooltip="fixedTooltip"
            :enable-rotation="enableRotation"
            @pedido="newPedido"
            @factura="newFactura"
            @entrada="newEntrada"
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
                firstIcon: 'settings',
                firstTooltip: 'Nuevo pedido',
                //second elem
                secondIcon: 'post_add',
                secondTooltip: 'Nueva factura',
                //third elem
                thirdIcon: 'compare_arrows',
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
            newPedido(){
                $(location).attr('href', '/pedido/nuevo');
            },
            newFactura(){
                alert('You have clicked factura :)');
            },
            newEntrada(){
                alert('You have clicked libro :)');
            }
        }
    }
</script>