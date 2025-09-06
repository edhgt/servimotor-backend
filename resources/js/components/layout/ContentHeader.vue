<template>
    <div class="app-content-header" v-if="$route.meta.title">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <h3 class="mb-0">{{$route.meta.title}}</h3>
          </div>
        </div>
      </div>
    </div>
</template>
