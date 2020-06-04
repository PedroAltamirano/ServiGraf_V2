<template>
  <nav class="m-2 m-md-3 p-0" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li v-for='e in links' :key="e.href" :class="['breadcrumb-item']"><a :href="e.href">{{e.text.toUpperCase()}}</a></li>
      <li v-for='e in currentL' :key="e.href" :class="['breadcrumb-item', 'active']" aria-current="page">{{e.text.toUpperCase()}}</li>
    </ol>
  </nav>
</template>

<script>
  export default {
    props: {
      items: {
        type: Array
      }
    },
    computed: {
      links: function(){
        return this.items.filter(e => e.current == false)
      },
      
      currentL: function(){
        return this.items.filter(e => e.current == true)
      }
    }
  }
</script>