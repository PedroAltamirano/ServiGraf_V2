<template>
  <div class="m-2 m-md-3">
    <div style="background-color: rgba(59,89,152,.8)" class="text-white rounded-top p-2">{{ title }}</div>
    <div class="p-2 p-md-3 m-0 border-left border-right"><slot></slot></div>
    <div class="bg-light rounded-bottom p-2">
      <template>
        <div class="d-flex">
          <div class="flex-grow-1 d-flex">
            <div v-for='e in links' :key="e.href" class="mr-2 mr-md-3"><a :id="e.id" :href="e.href" class="text-blue-8">{{e.text}} <i class="fas fa-arrow-alt-circle-right fa-md"></i></a></div>
          </div>
          <div v-for='e in buttons' :key="e.href" class="ml-2 ml-md-3">
            <a :onclick="e.href" :class="e.text" :id="e.id"></a>
          </div>
        </div>
      </template>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      title: String,
      foot: {
        type: Array
      }
    },
    computed: {
      links: function(){
        return this.foot.filter(e => e.tipo == 'link')
      },
      
      buttons: function(){
        return this.foot.filter(e => e.tipo == 'button')
      }
    }
  }
</script>