<?php

namespace Tests\Feature;

use App\Filament\Resources\LeadResource\Pages\ListLeads;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LeadsTabsTest extends TestCase
{
    use RefreshDatabase;

    public function test_every_leads_tab_renders(): void
    {
        $user = User::create([
            'name'     => 'Rochdi',
            'email'    => 'rochdi.karouali1234@gmail.com',
            'password' => bcrypt('secret-test-password'),
            'role'     => 'lead_viewer',
        ]);

        Lead::create(['type' => Lead::TYPE_WHATSAPP_CLICK, 'source' => 'home', 'status' => 'new', 'page_url' => 'https://morocco-quest.com/']);
        Lead::create(['type' => Lead::TYPE_PHONE_CLICK, 'source' => 'home', 'status' => 'new', 'page_url' => 'https://morocco-quest.com/']);
        Lead::create(['type' => Lead::TYPE_TOUR_INQUIRY, 'source' => 'marrakech', 'status' => 'new', 'name' => 'T', 'email' => 't@t.t', 'item_title' => '5-Day Marrakech']);

        $this->actingAs($user);

        foreach (['all', 'inquiries', 'whatsapp', 'phone'] as $tab) {
            Livewire::test(ListLeads::class, ['activeTab' => $tab])
                ->assertSuccessful();
        }
    }
}
