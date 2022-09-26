<section class="container my-5">
    <div class="container text-center mb-5 pb-5 border-bottom">
        <h1>Our Services</h1>
    </div>
    <div class="d-flex flex-wrap justify-content-center gap-3">
        <div class="card m-2" style="width: 18rem;">
            <img src="./public/images/products/id.jpg" height="250px" class="card-img-top" alt="White Shirt">
            <div class="card-body">
                <h5 class="card-title">ID Picture</h5>
                <p class="card-text text-secondary">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <p class="card-text">Php 250.00</p>
                <a href="#" class="btn btn-primary" onclick="redirectToID()"><i class="fa-solid fa-cart-shopping"></i> Buy now</a>
            </div>
        </div>
        <div class="card m-2" style="width: 18rem;">
            <img src="./public/images/products/document.jpeg" height="250px" class="card-img-top" alt="White Shirt">
            <div class="card-body">
                <h5 class="card-title">Documents</h5>
                <p class="card-text text-secondary">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <p class="card-text">Php 250.00</p>
                <a href="#" class="btn btn-primary" onclick="redirectToDocument()"><i class="fa-solid fa-cart-shopping"></i> Buy now</a>
            </div>
        </div>
        <div class="card m-2" style="width: 18rem;">
            <img src="./public/images/products/tarpaulin.jpeg" height="250px" class="card-img-top" alt="White Shirt">
            <div class="card-body">
                <h5 class="card-title">Tarpaulin</h5>
                <p class="card-text text-secondary">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <p class="card-text">Php 250.00</p>
                <a href="#" class="btn btn-primary" onclick="redirectToTarpaulin()"><i class="fa-solid fa-cart-shopping"></i> Buy now</a>
            </div>
        </div>
    </div>
</section>

<script>
    const redirectToID = () => window.location.href = "http://localhost/pcsps/index.php?page=addtocart&&item=id";
    const redirectToDocument = () => window.location.href = "http://localhost/pcsps/index.php?page=addtocart&&item=document";
    const redirectToTarpaulin = () => window.location.href = "http://localhost/pcsps/index.php?page=addtocart&&item=tarpaulin";
</script>