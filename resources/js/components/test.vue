<template>
    <mdb-select
      v-model="basicOptions"
      placeholder="Select an option"
      label=""
    />
</template>

<script>
  import mdbSelect from "mdbvue";
  export default {
    name: "SelectPage",
    components: {
      mdbSelect,
    },
    data() {
      return {
        basicOptions: [
          { text: "Option nr 1", value: "Option 1" },
          { text: "Option nr 2", value: "Option 2" },
          { text: "Option nr 3", value: "Option 3" }
        ]
      };
    }
  };
</script>