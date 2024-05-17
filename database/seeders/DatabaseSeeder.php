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
        $this->call(SettingsTableSeeder::class);
        $this->call(TranslationsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(OrganizersTableSeeder::class);
        $this->call(ActiesTableSeeder::class);
        $this->call(ThemesTableSeeder::class);
        $this->call(ActieThemeTableSeeder::class);
        $this->call(ActieCategoryTableSeeder::class);
        $this->call(ActieOrganizerTableSeeder::class);
        $this->call(ReportsTableSeeder::class);
        $this->call(JobsTableSeeder::class);
        $this->call(OrganizerThemeTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(AnswersTableSeeder::class);
        $this->call(DimensionsTableSeeder::class);
        $this->call(AnswerDimensionTableSeeder::class);
        $this->call(ReferentieTypesTableSeeder::class);
        $this->call(ReferentieTypeDimensionTableSeeder::class);
        $this->call(ReferentiesTableSeeder::class);
        $this->call(ReferentieThemeTableSeeder::class);
    }
}
