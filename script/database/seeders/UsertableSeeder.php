<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsertableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super = User::create([
            'role' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'plan_id' => 1,
            'username' => 'admin',
            'password' => Hash::make('rootadmin'),
            'email_verified_at' => now(),
            'phone_verified_at' => now()
        ]);

        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        
        //create permission
        $permissions = [
            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard',
                ]
            ],

            [
                'group_name' => 'admin',
                'permissions' => [
                    'admin.create',
                    'admin.edit',
                    'admin.update',
                    'admin.delete',
                    'admin.list',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    'role.create',
                    'role.edit',
                    'role.update',
                    'role.delete',
                    'role.list',

                ]
            ],
            [
                'group_name' => 'page',
                'permissions' => [
                    'page.create',
                    'page.edit',
                    'page.delete',
                    'page.index',

                ]
            ],
            [
                'group_name' => 'Blog',
                'permissions' => [
                    'blog.create',
                    'blog.edit',
                    'blog.delete',
                    'blog.index',
                ]
            ],
            [
                'group_name' => 'Settings',
                'permissions' => [
                    'site.settings',
                    'system.settings',
                    'seo.settings',
                    'menu',
                ]
            ],
            [
                'group_name' => 'language',
                'permissions' => [
                    'language.index',
                    'language.edit',
                    'language.create',
                    'language.delete',
                ]
            ],
            [
                'group_name' => 'category',
                'permissions' => [
                    'category.list',
                    'category.edit',
                    'category.create',
                    'category.delete',
                ]
            ],
            [
                'group_name' => 'tag',
                'permissions' => [
                    'tag.list',
                    'tag.edit',
                    'tag.create',
                    'tag.delete',
                ]
            ],
             [
                'group_name' => 'media',
                'permissions' => [
                    'media.list',

                ]
            ],
            [
                'group_name' => 'review',
                'permissions' => [
                    'review.list',
                    'review.edit',
                    'review.create',
                    'review.delete',
                ]
            ],

            [
                'group_name' => 'referral_commission',
                'permissions' => [
                    'referral_commission.index',
                    'referral_commission.edit',
                    'referral_commission.create',
                    'referral_commission.delete',
                ]
            ],
            [
                'group_name' => 'membership_plan',
                'permissions' => [
                    'membership_plan.index',
                    'membership_plan.edit',
                    'membership_plan.create',
                    'membership_plan.delete',
                ]
            ],
            [
                'group_name' => 'ptc_ads',
                'permissions' => [
                    'ptc_ad.index',
                    'ptc_ad.edit',
                    'ptc_ad.create',
                    'ptc_ad.delete',
                ]
            ],
            [
                'group_name' => 'manage_users',
                'permissions' => [
                    'user.list',
                    'user.edit',
                    'user.create',
                    'user.delete',
                ]
            ],
            [
                'group_name' => 'deposits',
                'permissions' => [
                    'deposit.list',
                    'deposit.edit',
                    'deposit.create',
                    'deposit.delete',
                ]
            ],
            [
                'group_name' => 'getway',
                'permissions' => [
                    'getway.list',
                    'getway.edit',
                    'getway.create',
                    'getway.delete',
                ]
            ],

            [
                'group_name' => 'withdrawlmethod',
                'permissions' => [
                    'withdrawlmethod.list',
                    'withdrawlmethod.create',
                    'withdrawlmethod.edit',
                    'withdrawlmethod.delete',
                ]
            ],

            [
                'group_name' => 'withdraws',
                'permissions' => [
                    'withdraws.list',
                    'withdraws.create',
                    'withdraws.edit',
                    'withdraws.delete',
                ]
            ],
            [
                'group_name' => 'report',
                'permissions' => [
                    'report.list',
                    'report.transaction',
                    'report.loginHistory',
                    'report.emailHistory',
                    'report.ptcview',
                ]
            ],
            [
                'group_name' => 'subscriber',
                'permissions' => [
                    'subscriber.list',
                    'subscriber.send',
                    'subscriber.delete'
                ]
            ],
            [
                'group_name' => 'Support',
                'permissions' => [
                    'support.list',
                    'support.edit',
                    'support.delete'
                ]
            ],
        ];

        //assign permission

        foreach ($permissions as $key => $row) {
            foreach ($row['permissions'] as $per) {
                $permission = Permission::create(['name' => $per, 'group_name' => $row['group_name']]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
                $super->assignRole($roleSuperAdmin);
            }
        }

        Role::create(['name' => 'user']);

    }
}
