<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        	UsersTableSeeder::class,
            // Settings
            SettingsTableSeeder::class,
        	// Post Seeder
            PostCategoryTableSeeder::class,
            PostDesignTableSeeder::class,
            PostStatusTableSeeder::class,
            PostTableSeeder::class,
            PostTagTableSeeder::class,
            // postRTagTableSeeder::class,
            // Roles and Permissions Seeder
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,

            // Product Seeder
            ProductAttributeSetTableSeeder::class,    
            ProductCategoryTableSeeder::class,
            ProductAttributeTableSeeder::class,
            ProductAttributeValueTableSeeder::class,
            ProductAttributeImageTableSeeder::class,
            ProductDesignTableSeeder::class,
            CustomProductCategoryTableSeeder::class,    
            MfdCountriesTableSeeder::class,

            // Tax Management
            TaxCountryTableSeeder::class,

            // Inventory Units
            InventoryUnitTypeTableSeeder::class,
            InventoryUnitTableSeeder::class,

            // Fabric Seeder
            BrandsTableSeeder::class,
            FabricBrandsTableSeeder::class,
            FabricCLassesTableSeeder::class,
            FabricStatusTableSeeder::class,
            FabricAttributesTableSeeder::class,
            FabricAttributeValuesTableSeeder::class,
            
            // Measurement Seeder
            MeasurementAttributeTableSeeder::class,
            MeasurementAttributeValueTableSeeder::class,
            MeasurementCategoryTableSeeder::class,
            MeasurementProfileTableSeeder::class,
            MeasurementProfileValueTableSeeder::class,
            // User Measurement
            UserMeasurementProfileTableSeeder::class,
            UserMeasurementProfileValueTableSeeder::class,
            // Measurement
            MonogramTableSeeder::class,
            StatusTableSeeder::class,

        ]);
    }
}
