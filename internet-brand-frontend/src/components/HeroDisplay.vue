<template>
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Uyo-Obong Akpan</h1>
            <p class="col-md-8 fs-4">Your task is to implement a simple page with an input form to take in credit
                card information and send it to a Backend API for validation.</p>
            <button @click="goToProject" class="btn btn-primary btn-lg" type="button">Visit Project</button>
        </div>
    </div>
</template>

<script setup>
const goToProject = () => {
    window.location.href = 'https://github.com/uyo-obong/assessment-ib';
};
</script>
