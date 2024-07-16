<style>
    .container-fluid {
        padding-top: 100px; 
        padding-bottom: 20px; 
    }

    .alert {
        text-align: center; 
        padding: 20px; 
        margin-bottom: 0; 
    }

    .alert-success {
        color: #155724; 
        background-color: #d4edda; 
        border-color: #c3e6cb; 
    }
  
     .btn-back-home {
        margin-top: 10px; 
        background-color: #2B6377; 
        border-color: #2B6377; 
        color: #fff; 
        float: right; 
        width: 120px;
        text-align: center; 
        padding: 6px 12px; 
    }

    .btn-back-home:hover {
        background-color: #12947f;
        border-color: #12947f; 
    }
</style>

<div class="container-fluid">
    <div class="alert alert-success">
        <p class="mb-0">Your order was successful</p>
    </div>

    <a href="<?php echo base_url('/landingpage') ?>" class="btn btn-back-home btn-block">Back</a>

</div>
