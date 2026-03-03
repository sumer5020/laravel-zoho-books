<?php

declare(strict_types=1);

namespace Sumer5020\ZohoBooks;

use Illuminate\Support\ServiceProvider;
use Sumer5020\ZohoBooks\Console\Commands\ZohoBooksInit;
use Sumer5020\ZohoBooks\Contracts\AuthenticationInterface;
use Sumer5020\ZohoBooks\Services\AuthenticationService;
use Sumer5020\ZohoBooks\Contracts\ContactInterface;
use Sumer5020\ZohoBooks\Services\ContactService;
use Sumer5020\ZohoBooks\Contracts\BankAccountInterface;
use Sumer5020\ZohoBooks\Services\BankAccountService;
use Sumer5020\ZohoBooks\Contracts\BankRuleInterface;
use Sumer5020\ZohoBooks\Services\BankRuleService;
use Sumer5020\ZohoBooks\Contracts\BankTransactionInterface;
use Sumer5020\ZohoBooks\Services\BankTransactionService;
use Sumer5020\ZohoBooks\Contracts\BaseCurrencyAdjustmentInterface;
use Sumer5020\ZohoBooks\Services\BaseCurrencyAdjustmentService;
use Sumer5020\ZohoBooks\Contracts\BillInterface;
use Sumer5020\ZohoBooks\Services\BillService;
use Sumer5020\ZohoBooks\Contracts\ChartOfAccountInterface;
use Sumer5020\ZohoBooks\Services\ChartOfAccountService;
use Sumer5020\ZohoBooks\Contracts\ContactPersonInterface;
use Sumer5020\ZohoBooks\Services\ContactPersonService;
use Sumer5020\ZohoBooks\Contracts\CreditNoteInterface;
use Sumer5020\ZohoBooks\Services\CreditNoteService;
use Sumer5020\ZohoBooks\Contracts\CurrencyInterface;
use Sumer5020\ZohoBooks\Services\CurrencyService;
use Sumer5020\ZohoBooks\Contracts\CustomerPaymentInterface;
use Sumer5020\ZohoBooks\Services\CustomerPaymentService;
use Sumer5020\ZohoBooks\Contracts\CustomModuleInterface;
use Sumer5020\ZohoBooks\Services\CustomModuleService;
use Sumer5020\ZohoBooks\Contracts\EstimateInterface;
use Sumer5020\ZohoBooks\Services\EstimateService;
use Sumer5020\ZohoBooks\Contracts\ExpenseInterface;
use Sumer5020\ZohoBooks\Services\ExpenseService;
use Sumer5020\ZohoBooks\Contracts\InvoiceInterface;
use Sumer5020\ZohoBooks\Services\InvoiceService;
use Sumer5020\ZohoBooks\Contracts\ItemInterface;
use Sumer5020\ZohoBooks\Services\ItemService;
use Sumer5020\ZohoBooks\Contracts\JournalInterface;
use Sumer5020\ZohoBooks\Services\JournalService;
use Sumer5020\ZohoBooks\Contracts\OpeningBalanceInterface;
use Sumer5020\ZohoBooks\Services\OpeningBalanceService;
use Sumer5020\ZohoBooks\Contracts\ProjectInterface;
use Sumer5020\ZohoBooks\Services\ProjectService;
use Sumer5020\ZohoBooks\Contracts\PurchaseOrderInterface;
use Sumer5020\ZohoBooks\Services\PurchaseOrderService;
use Sumer5020\ZohoBooks\Contracts\RecurringBillInterface;
use Sumer5020\ZohoBooks\Services\RecurringBillService;
use Sumer5020\ZohoBooks\Contracts\RecurringExpenseInterface;
use Sumer5020\ZohoBooks\Services\RecurringExpenseService;
use Sumer5020\ZohoBooks\Contracts\RecurringInvoiceInterface;
use Sumer5020\ZohoBooks\Services\RecurringInvoiceService;
use Sumer5020\ZohoBooks\Contracts\RetainerInvoiceInterface;
use Sumer5020\ZohoBooks\Services\RetainerInvoiceService;
use Sumer5020\ZohoBooks\Contracts\SalesOrderInterface;
use Sumer5020\ZohoBooks\Services\SalesOrderService;
use Sumer5020\ZohoBooks\Contracts\TaskInterface;
use Sumer5020\ZohoBooks\Services\TaskService;
use Sumer5020\ZohoBooks\Contracts\TaxInterface;
use Sumer5020\ZohoBooks\Services\TaxService;
use Sumer5020\ZohoBooks\Contracts\TimeEntryInterface;
use Sumer5020\ZohoBooks\Services\TimeEntryService;
use Sumer5020\ZohoBooks\Contracts\UserInterface;
use Sumer5020\ZohoBooks\Services\UserService;
use Sumer5020\ZohoBooks\Contracts\VendorCreditInterface;
use Sumer5020\ZohoBooks\Services\VendorCreditService;
use Sumer5020\ZohoBooks\Contracts\VendorPaymentInterface;
use Sumer5020\ZohoBooks\Services\VendorPaymentService;
use Sumer5020\ZohoBooks\Contracts\ZohoCrmIntegrationInterface;
use Sumer5020\ZohoBooks\Services\ZohoCrmIntegrationService;

class ZohoBooksServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->publishConfig();
        $this->publishMigrations();
        $this->registerCommands();
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/zohoBooks.php', 'zohoBooks');
        $this->registerBindings();
        $this->registerZohoBooks();
    }

    /**
     * Bind interfaces to their implementations
     */
    private function registerBindings(): void
    {
        $bindings = [
            AuthenticationInterface::class => AuthenticationService::class,
            ContactInterface::class => ContactService::class,
            BankAccountInterface::class => BankAccountService::class,
            BankRuleInterface::class => BankRuleService::class,
            BankTransactionInterface::class => BankTransactionService::class,
            BaseCurrencyAdjustmentInterface::class => BaseCurrencyAdjustmentService::class,
            BillInterface::class => BillService::class,
            ChartOfAccountInterface::class => ChartOfAccountService::class,
            ContactPersonInterface::class => ContactPersonService::class,
            CreditNoteInterface::class => CreditNoteService::class,
            CurrencyInterface::class => CurrencyService::class,
            CustomerPaymentInterface::class => CustomerPaymentService::class,
            CustomModuleInterface::class => CustomModuleService::class,
            EstimateInterface::class => EstimateService::class,
            ExpenseInterface::class => ExpenseService::class,
            InvoiceInterface::class => InvoiceService::class,
            ItemInterface::class => ItemService::class,
            JournalInterface::class => JournalService::class,
            OpeningBalanceInterface::class => OpeningBalanceService::class,
            ProjectInterface::class => ProjectService::class,
            PurchaseOrderInterface::class => PurchaseOrderService::class,
            RecurringBillInterface::class => RecurringBillService::class,
            RecurringExpenseInterface::class => RecurringExpenseService::class,
            RecurringInvoiceInterface::class => RecurringInvoiceService::class,
            RetainerInvoiceInterface::class => RetainerInvoiceService::class,
            SalesOrderInterface::class => SalesOrderService::class,
            TaskInterface::class => TaskService::class,
            TaxInterface::class => TaxService::class,
            TimeEntryInterface::class => TimeEntryService::class,
            UserInterface::class => UserService::class,
            VendorCreditInterface::class => VendorCreditService::class,
            VendorPaymentInterface::class => VendorPaymentService::class,
            ZohoCrmIntegrationInterface::class => ZohoCrmIntegrationService::class,
        ];

        foreach ($bindings as $interface => $implementation) {
            $this->app->singleton($interface, $implementation);
        }
    }

    /**
     * Registers zohoBooks.
     */
    private function registerZohoBooks(): void
    {
        $this->app->singleton('zohoBooks', function ($app) {
            return new ZohoBooks($app);
        });
    }

    /**
     * Publish package's config file.
     */
    private function publishConfig(): void
    {
        $this->publishes([
            __DIR__ . '/../config/zohoBooks.php' => config_path('zohoBooks.php'),
        ], 'zohoBooks-config');
    }

    /**
     * Publish package's migrations.
     */
    private function publishMigrations(): void
    {
        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateZohoTokensTables')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_zoho_tokens_tables.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_zoho_tokens_tables.php'),
                ], 'zohoBooks-migrations');
            }
        }
    }

    /**
     * Register console commands.
     */
    private function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ZohoBooksInit::class
            ]);
        }
    }
}
