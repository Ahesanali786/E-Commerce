<div class="color-options">
    <label for="color-select">Select Color:</label>
    <div class="color-picker">
        <div class="color-option" data-color="red" style="background-color: red;"></div>
        <div class="color-option" data-color="blue" style="background-color: blue;"></div>
        <div class="color-option" data-color="green" style="background-color: green;"></div>
        <!-- Add more color options as needed -->
    </div>
    <div id="selected-color">Selected Color: None</div>
</div>

<style>
    .color-options {
        margin-bottom: 20px;
    }

    .color-picker {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .color-option {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
        border: 2px solid #ccc;
    }

    .color-option:hover {
        border: 2px solid #007bff;
    }

    .color-option.selected {
        border: 2px solid #007bff;
    }
</style>

<script>
    const colorOptions = document.querySelectorAll('.color-option');
    const selectedColorDisplay = document.getElementById('selected-color');

    colorOptions.forEach(option => {
        option.addEventListener('click', () => {
            // Remove 'selected' class from all options
            colorOptions.forEach(opt => opt.classList.remove('selected'));

            // Add 'selected' class to the clicked option
            option.classList.add('selected');

            // Update the selected color display
            const colorName = option.getAttribute('data-color');
            selectedColorDisplay.textContent = `Selected Color: ${colorName}`;
        });
    });
</script>



Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
    $table->unsignedBigInteger('address_id');
    $table->foreign('address_id')->references('id')->on('addresses')->onUpdate('cascade')->onDelete('cascade');
    $table->string('payment_method');
    $table->timestamps();
});


Schema::create('order_details', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
    $table->unsignedBigInteger('order_id');
    $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
    $table->unsignedBigInteger('product_id');
    $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
    $table->integer('qty');
    $table->integer('product_price');
    $table->bigInteger('total');
    $table->timestamps();
});
