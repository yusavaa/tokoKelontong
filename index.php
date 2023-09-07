<?php
require 'functions.php';

$products = query("SELECT * FROM produk");

$carts = addToCart();
var_dump($carts);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="uwu.js"></script>
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
    <title>Toko Kelontong</title>
</head>

<body>
    <div class="w-4/5 m-auto shadow-xl">

        <header class="flex items-center justify-between bg-red-600 border-b-8 border-orange-200">
            <h1 class="p-4 text-4xl text-white font-bold">Toko Kelontong</h1>
            <nav class="p-4">
                <ul class="flex gap-4 text-white font-bold">
                    <li><a class="p-2 rounded-lg hover:bg-red-500" href="index.php">Belanja</a></li>
                    <li><a class="p-2 rounded-lg hover:bg-red-500" href="">Akun</a></li>
                </ul>
            </nav>
        </header>

        <main class="flex bg-white">
            <section class="p-4 w-2/3">
                <h2 class="pb-4 border-b-2 text-xl font-bold">Belanja</h2>
                <!-- Card Layout Start -->
                <div class="grid grid-cols-4 gap-5 pt-5">
                    <?php foreach ($products as $product) : ?>
                        <div class="p-3 w-44 border-2 border-slate-200 rounded-lg bg-white shadow-lg hover:border-slate-700">
                            <img src="images/<?= $product["gambar"] ?>">
                            <h3 class="mt-3 truncate"><?= $product["nama"] ?></h3>
                            <h3 class="font-semibold">Rp<?= $product["harga"] ?></h3>
                            <a class="flex justify-center mt-3 p-1 rounded-lg w-full bg-orange-200 hover:bg-orange-300" href="?id=<?= $product["id"] ?>">Tambah</a>
                        </div>
                    <?php endforeach ?>
                </div>
                <!-- Card Layout End -->
            </section>

            <aside class="p-4 w-1/3 border-l-2 bg-white">
                <h2 class="text-xl font-bold">Keranjang</h2>
                <section class="flex flex-col gap-4 mt-4 py-5 border-y-2  max-h-96 overflow-y-auto">
                    <?php if (isset($carts)) {
                        foreach ($carts as $key => $value) :
                            $products = query("SELECT * FROM produk WHERE id = '$key'");
                            foreach ($products as $product) : ?>

                                <!-- Cart Card Start -->
                                <div class="flex p-2 border-2 border-slate-200 rounded-lg bg-white shadow-lg hover:border-slate-700">
                                    <img class="w-24" src="images/<?= $product["gambar"] ?>">
                                    <div class="pl-2 w-60">
                                        <h3 class=""><?= $product["nama"] ?></h3>
                                        <h3 class="font-semibold">Rp<?= $product["harga"] ?></h3>
                                        <div class="flex justify-end mt-4">
                                            <a class="border-2 px-2 bg-white font-bold" onclick="decrement(<?= $key ?>)">-</a>
                                            <input class="border-y-2 w-10 text-center" type="number" id="<?= $key ?>" value="<?= $value ?>">
                                            <a class="border-2 px-2 bg-white font-bold" onclick="increment(<?= $key ?>)">+</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Cart Card End -->

                            <?php endforeach ?>
                        <?php endforeach ?>
                    <?php } else { ?>
                        <p class="flex justify-center py-11 text-center">Wah, keranjangmu masih kosong.</p>
                    <?php } ?>
                </section>
                <h2 class="flex justify-end mt-4 font-semibold">Total: Rp</h2>
                <section class="flex gap-6 mt-4">
                    <a class="flex justify-center border-2 border-red-600 rounded-lg p-2 w-1/3 font-semibold hover:bg-red-600 hover:text-white" href="clearCart.php">Kosongkan</a>
                    <a class="flex justify-center rounded-lg p-2 w-2/3 bg-sky-600 text-white font-semibold hover:bg-sky-500" href="">Bayar</a>
                </section>
            </aside>
        </main>

        <footer class="flex justify-center p-4 bg-slate-700">
            <h5 class="text-white">by <span class="font-bold">Fath Yusava</span></h5>
        </footer>
    </div>
</body>

</html>