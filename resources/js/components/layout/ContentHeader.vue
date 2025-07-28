<template>
    <div class="app-content-header" v-if="$route.meta.title">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <h2 class="mb-0">{{$route.meta.title}}</h2>
          </div>
        </div>
      </div>
    </div>
</template>
