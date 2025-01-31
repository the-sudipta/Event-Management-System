<div id="loadingOverlay">
    <div class="loader"></div>
</div>

<style>
    /* Full-page overlay */
    #loadingOverlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7); /* Dark semi-transparent */
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    /* Spinning Loader */
    .loader {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #ff416c;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: spin 1s linear infinite;
    }

    /* Loader Animation */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
