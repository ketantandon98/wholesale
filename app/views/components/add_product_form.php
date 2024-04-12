<!-- Form to add a product -->
<form method="POST" action="?page=dashboard" class="add-prducts-form-admin">
    <div class="input-control">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required>
    </div>
    <div class="input-control">
        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price" required>
    </div>
    <div class="input-control">
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required></textarea>
    </div>
    <div class="input-control">
        <label for="category">Category:</label><br>
        <input type="text" id="category" name="category" required>
    </div>
    <div class="input-control">
        <label for="image_path">Image Path:</label><br>
        <input type="text" id="image_path" name="image_path" required>
    </div>
    <div class="input-control">
        <button type="submit" name="add_product">Add Product</button>
    </div>

</form>