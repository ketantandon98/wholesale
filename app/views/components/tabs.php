<div class="container">
    <h3>Browse our products by categories</h3>

    <div class="pcss3t pcss3t-effect-scale pcss3t-theme-1">
        <input type="radio" name="pcss3t" checked id="tab1" class="tab-content-first">
        <label for="tab1"><i class="icon-bolt"></i>Watches</label>

        <input type="radio" name="pcss3t" id="tab2" class="tab-content-2">
        <label for="tab2"><i class="icon-picture"></i>Furniture</label>

        <input type="radio" name="pcss3t" id="tab3" class="tab-content-3">
        <label for="tab3"><i class="icon-cogs"></i>Shirts</label>

        <input type="radio" name="pcss3t" id="tab5" class="tab-content-last">
        <label for="tab5"><i class="icon-globe"></i>Tech Gadgets</label>
        <section class="tabs-ul">


            <li class="tab-content tab-content-first typography li">
                <?php require_once "subcomponents/watches.php"; ?>
            </li>

            <li class="tab-content tab-content-2 typography">
                <?php require_once "subcomponents/furniture.php"; ?>

            </li>

            <li class="tab-content tab-content-3 typography">
                <?php require_once "subcomponents/shirts.php"; ?>

            </li>

            <li class="tab-content tab-content-last typography">
                <div class="typography">
                    <?php require_once "subcomponents/gadgets.php"; ?>
                </div>
            </li>
        </section>
    </div>
</div>