<template>
  <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item {{active}}" aria-current="page" v-for='dir in path'>{{dir.name}}</li>
  </ol>
</nav>
</template>