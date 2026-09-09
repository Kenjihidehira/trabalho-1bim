<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductItens;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductListingTest extends TestCase
{
    use RefreshDatabase;

    public function test_listing_displays_all_products_with_their_own_items_in_name_order(): void
    {
        $mesa = $this->createProduct(['nome' => 'Mesa']);
        $mesaItem = $mesa->itens()->create(['quantidade' => '4.000', 'cor' => 'Carvalho', 'valor' => '19.90']);
        $cadeira = $this->createProduct(['nome' => 'Cadeira']);
        $cadeiraItem = $cadeira->itens()->create(['quantidade' => '1.000', 'cor' => 'Grafite', 'valor' => '45.50']);

        $this->get(route('products.index'))
            ->assertOk()
            ->assertViewIs('products.index')
            ->assertSeeInOrder(['Cadeira', 'Grafite', 'Mesa', 'Carvalho'])
            ->assertViewHas('products', function (Collection $products) use ($cadeira, $cadeiraItem, $mesa, $mesaItem) {
                return $products->modelKeys() === [$cadeira->id, $mesa->id]
                    && $products->every(fn (Product $product) => $product->relationLoaded('itens'))
                    && $products[0]->itens->modelKeys() === [$cadeiraItem->id]
                    && $products[1]->itens->modelKeys() === [$mesaItem->id];
            });
    }

    public function test_empty_database_displays_the_empty_state(): void
    {
        $this->get(route('products.index'))
            ->assertOk()
            ->assertSee('Nenhum produto')
            ->assertViewHas('products', fn (Collection $products) => $products->isEmpty());
    }

    public function test_product_without_items_can_be_listed_and_opened(): void
    {
        $product = $this->createProduct();

        $this->get(route('products.index'))->assertOk()->assertSee($product->nome);
        $this->get(route('products.items.index', $product))
            ->assertOk()
            ->assertViewHas('product', fn (Product $loaded) => $loaded->itens->isEmpty());
    }

    public function test_items_page_displays_only_the_selected_product_items(): void
    {
        $product = $this->createProduct(['nome' => 'Tecido']);
        $item = $product->itens()->create(['quantidade' => '2.500', 'cor' => 'Areia', 'valor' => '39.90']);
        $other = $this->createProduct(['nome' => 'Poltrona']);
        $other->itens()->create(['quantidade' => '1.000', 'cor' => 'Vermelho', 'valor' => '99.90']);

        $this->get(route('products.items.index', $product))
            ->assertOk()
            ->assertViewIs('products.items')
            ->assertSee('Tecido')
            ->assertSee('Areia')
            ->assertDontSee('Poltrona')
            ->assertDontSee('Vermelho')
            ->assertViewHas('product', fn (Product $loaded) => $loaded->is($product)
                && $loaded->relationLoaded('itens')
                && $loaded->itens->modelKeys() === [$item->id]);

        $this->assertTrue($item->product->is($product));
    }

    public function test_unknown_product_returns_404(): void
    {
        $this->get(route('products.items.index', 999999))->assertNotFound();
    }

    public function test_money_and_fractional_quantity_survive_a_database_round_trip(): void
    {
        $product = $this->createProduct(['preco' => '1299.90']);
        $item = $product->itens()->create(['quantidade' => '0.125', 'cor' => 'Bege', 'valor' => '0.10']);

        $this->assertSame('1299.90', $product->fresh()->preco);
        $this->assertSame('0.125', $item->fresh()->quantidade);
        $this->assertSame('0.10', $item->fresh()->valor);
    }

    public function test_item_cannot_reference_a_missing_product(): void
    {
        $this->expectException(QueryException::class);

        ProductItens::create([
            'product_id' => 999999,
            'quantidade' => '1.000',
            'cor' => 'Preto',
            'valor' => '10.00',
        ]);
    }

    public function test_product_with_items_cannot_be_deleted(): void
    {
        $product = $this->createProduct();
        $product->itens()->create(['quantidade' => '1.000', 'cor' => 'Preto', 'valor' => '10.00']);

        $this->expectException(QueryException::class);

        $product->delete();
    }

    public function test_product_and_item_text_are_escaped_in_both_pages(): void
    {
        $name = '<script>alert("produto")</script>';
        $color = '<img src=x onerror=alert("item")>';
        $product = $this->createProduct(['nome' => $name]);
        $product->itens()->create(['quantidade' => '1.000', 'cor' => $color, 'valor' => '10.00']);

        foreach ([route('products.index'), route('products.items.index', $product)] as $url) {
            $this->get($url)
                ->assertOk()
                ->assertSee($name)
                ->assertSee($color)
                ->assertDontSee($name, false)
                ->assertDontSee($color, false);
        }
    }

    public function test_demo_seed_can_be_repeated_without_duplicating_products_or_items(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseCount('products', 3);
        $this->assertDatabaseCount('product_itens', 6);
        $this->assertSame(3, Product::has('itens', '=', 2)->count());
    }

    private function createProduct(array $attributes = []): Product
    {
        return Product::create(array_merge([
            'nome' => 'Produto de teste',
            'preco' => '149.90',
            'unidade_medida' => 'un',
        ], $attributes));
    }
}
