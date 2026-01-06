<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Base Seeders
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);
        $this->call(AnnouncementsTableSeeder::class);
        $this->call(DataTypesTableSeeder::class);
        $this->call(DataRowsTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(MenuItemsTableSeeder::class);
        $this->call(NotificationsTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(PermissionGroupsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(TranslationsTableSeeder::class);
        $this->call(JobsTableSeeder::class);

        // Custom Model Seeders
        $this->call(CategoriesTableFactorySeeder::class);
        // $this->call(ThemesTableFactorySeeder::class);
        $this->call(ThemesTableSeeder::class);
        $this->call(OrganizersTableFactorySeeder::class);
        $this->call(ActiesTableFactorySeeder::class);
        $this->call(ActieThemeTableFactorySeeder::class);
        $this->call(ActieCategoryTableFactorySeeder::class);
        $this->call(ActieOrganizerTableFactorySeeder::class);
        $this->call(ReportsTableFactorySeeder::class);
        $this->call(OrganizerThemeTableFactorySeeder::class);

        $this->call(QuestionsTableSeeder::class);
        $this->call(AnswersTableSeeder::class);
        $this->call(DimensionsTableSeeder::class);
        $this->call(AnswerDimensionTableSeeder::class);
        $this->call(ReferentieTypesTableSeeder::class);
        $this->call(ReferentieTypeDimensionTableSeeder::class);
        $this->call(ReferentiesTableFactorySeeder::class);
        $this->call(ReferentieThemeTableSeeder::class);
    }
}
