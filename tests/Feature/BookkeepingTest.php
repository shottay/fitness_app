<?php

use App\Models\User;
use App\Models\Expense;
use App\Models\BookCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

// Using RefreshDatabase to ensure a clean database state for each test
uses(RefreshDatabase::class);

describe('Bookkeeping Feature', function() {
    beforeEach(function() {
        // Setup: Create a user and category, and authenticate
        $this->user = User::factory()->create();
        $this->category = BookCategory::factory()->create([
            'name' => 'Lebensmittel',
            'type' => 'expense'
        ]);
        
        // Authenticate the user
        $this->actingAs($this->user);
    });

    it('allows users to create a new expense', function() {
        // Arrange
        $expenseData = [
            'amount' => 50.00,
            'category_id' => $this->category->id,
            'date' => now()->format('Y-m-d'),
            'description' => 'Wocheneinkauf'
        ];

        // Act
        $response = $this->post(route('expenses.store'), $expenseData);

        // Assert
        $response->assertRedirect(route('bookkeeping.index'));
        
        // Check if expense was created in database
        $this->assertDatabaseHas('expenses', [
            'amount' => 50.00,
            'category_id' => $this->category->id,
            'description' => 'Wocheneinkauf',
            'user_id' => $this->user->id
        ]);

        // Verify the total expenses are updated
        $totalExpenses = Expense::where('user_id', $this->user->id)
            ->sum('amount');
        
        $this->assertEquals(50.00, $totalExpenses);
    });

    it('validates required fields when creating an expense', function() {
        // Arrange
        $expenseData = [
            'amount' => '',
            'category_id' => '',
            'date' => '',
            'description' => ''
        ];

        // Act
        $response = $this->post(route('expenses.store'), $expenseData);

        // Assert
        $response->assertSessionHasErrors(['amount', 'category_id', 'date', 'description']);
        
        // Verify no expense was created
        $this->assertDatabaseCount('expenses', 0);
    });

    it('validates expense amount is numeric and positive', function() {
        // Arrange
        $expenseData = [
            'amount' => -50.00,
            'category_id' => $this->category->id,
            'date' => now()->format('Y-m-d'),
            'description' => 'Wocheneinkauf'
        ];

        // Act
        $response = $this->post(route('expenses.store'), $expenseData);

        // Assert
        $response->assertSessionHasErrors(['amount']);
        
        // Verify no expense was created
        $this->assertDatabaseCount('expenses', 0);
    });
});