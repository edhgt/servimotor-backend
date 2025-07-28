<template>
    <div class="btn-group dropstart">
        <a href="#" role="button" class="text-body" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-three-dots"></i>
        </a>
        <ul class="dropdown-menu">
            <li><slot name="dropdownItem"></slot></li>
        </ul>
    </div>
</template>