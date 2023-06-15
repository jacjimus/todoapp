<template>
    <div class="modal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <!-- Task details -->
            <h2>{{ task.title }}</h2>
            <p>{{ task.description }}</p>
        </div>
    </div>
</template>

<style>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 4px;
}
</style>
