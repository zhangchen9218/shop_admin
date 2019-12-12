<?php

use Illuminate\Database\Seeder;

class PowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('powers')->insert([
            //管理员管理
            ["name" => "管理员管理", "field"=>"adn", "belong_to"=>"0", "acme" => "1"],
            ["name" => "管理员列表", "field"=>"adn.index", "belong_to"=>"1", "acme" => "0"],
            ["name" => "管理员创建（执行）", "field"=>"adn.store", "belong_to"=>"1", "acme" => "0"],
            ["name" => "管理员创建", "field"=>"adn.create", "belong_to"=>"1", "acme" => "0"],
            ["name" => "管理员修改状态", "field"=>"adn.edit_state", "belong_to"=>"1", "acme" => "0"],
            ["name" => "管理员显示", "field"=>"adn.show", "belong_to"=>"1", "acme" => "0"],
            ["name" => "管理员修改（执行）", "field"=>"adn.update", "belong_to"=>"1", "acme" => "0"],
            ["name" => "管理员删除", "field"=>"adn.destroy", "belong_to"=>"1", "acme" => "0"],
            ["name" => "管理员修改", "field"=>"adn.edit", "belong_to"=>"1", "acme" => "0"],
            //角色管理
            ["name" => "角色列表", "field"=>"role.index", "belong_to"=>"1", "acme" => "0"],
            ["name" => "角色创建（执行）", "field"=>"role.store", "belong_to"=>"1", "acme" => "0"],
            ["name" => "角色创建", "field"=>"role.create", "belong_to"=>"1", "acme" => "0"],
            ["name" => "角色显示", "field"=>"role.show", "belong_to"=>"1", "acme" => "0"],
            ["name" => "角色修改（执行）", "field"=>"role.update", "belong_to"=>"1", "acme" => "0"],
            ["name" => "角色删除", "field"=>"role.destroy", "belong_to"=>"1", "acme" => "0"],
            ["name" => "角色修改", "field"=>"role.edit", "belong_to"=>"1", "acme" => "0"],
            //权限管理
            ["name" => "权限列表", "field"=>"power.index", "belong_to"=>"1", "acme" => "0"],
            ["name" => "权限创建（执行）", "field"=>"power.store", "belong_to"=>"1", "acme" => "0"],
            ["name" => "权限创建", "field"=>"power.create", "belong_to"=>"1", "acme" => "0"],
            ["name" => "权限显示", "field"=>"power.show", "belong_to"=>"1", "acme" => "0"],
            ["name" => "权限修改（执行）", "field"=>"power.update", "belong_to"=>"1", "acme" => "0"],
            ["name" => "权限删除", "field"=>"power.destroy", "belong_to"=>"1", "acme" => "0"],
            ["name" => "权限修改", "field"=>"power.edit", "belong_to"=>"1", "acme" => "0"],

            //资讯管理
            ["name" => "资讯管理", "field"=>"article", "belong_to"=>"0", "acme" => "1"],
            ["name" => "资讯列表", "field"=>"article.index", "belong_to"=>"24", "acme" => "0"],
            ["name" => "资讯创建（执行）", "field"=>"article.store", "belong_to"=>"24", "acme" => "0"],
            ["name" => "资讯创建", "field"=>"article.create", "belong_to"=>"24", "acme" => "0"],
            ["name" => "资讯修改状态", "field"=>"article.edit_state", "belong_to"=>"24", "acme" => "0"],
            ["name" => "资讯显示", "field"=>"article.show", "belong_to"=>"24", "acme" => "0"],
            ["name" => "资讯修改（执行）", "field"=>"article.update", "belong_to"=>"24", "acme" => "0"],
            ["name" => "资讯删除", "field"=>"article.destroy", "belong_to"=>"24", "acme" => "0"],
            ["name" => "资讯修改", "field"=>"article.edit", "belong_to"=>"24", "acme" => "0"],

            ["name" => "分类列表", "field"=>"art_category.index", "belong_to"=>"24", "acme" => "0"],
            ["name" => "分类创建（执行）", "field"=>"art_category.store", "belong_to"=>"24", "acme" => "0"],
            ["name" => "分类创建", "field"=>"art_category.create", "belong_to"=>"24", "acme" => "0"],
            ["name" => "分类修改状态", "field"=>"art_category.edit_state", "belong_to"=>"24", "acme" => "0"],
            ["name" => "分类显示", "field"=>"art_category.show", "belong_to"=>"24", "acme" => "0"],
            ["name" => "分类修改（执行）", "field"=>"art_category.update", "belong_to"=>"24", "acme" => "0"],
            ["name" => "分类删除", "field"=>"art_category.destroy", "belong_to"=>"24", "acme" => "0"],
            ["name" => "分类修改", "field"=>"art_category.edit", "belong_to"=>"24", "acme" => "0"],

            //模板管理
            ["name" => "模板管理", "field"=>"template", "belong_to"=>"0", "acme" => "1"],
            ["name" => "模板列表", "field"=>"template.index", "belong_to"=>"41", "acme" => "0"],
            ["name" => "模板创建（执行）", "field"=>"template.store", "belong_to"=>"41", "acme" => "0"],
            ["name" => "模板创建", "field"=>"template.create", "belong_to"=>"41", "acme" => "0"],
            ["name" => "模板修改状态", "field"=>"template.edit_state", "belong_to"=>"41", "acme" => "0"],
            ["name" => "模板显示", "field"=>"template.show", "belong_to"=>"41", "acme" => "0"],
            ["name" => "模板修改（执行）", "field"=>"template.update", "belong_to"=>"41", "acme" => "0"],
            ["name" => "模板删除", "field"=>"template.destroy", "belong_to"=>"41", "acme" => "0"],
            ["name" => "模板修改", "field"=>"template.edit", "belong_to"=>"41", "acme" => "0"],

            //系统管理
            ["name" => "系统管理", "field"=>"system", "belong_to"=>"0", "acme" => "1"],
            ["name" => "栏目列表", "field"=>"column.index", "belong_to"=>"50", "acme" => "0"],
            ["name" => "栏目创建（执行）", "field"=>"column.store", "belong_to"=>"50", "acme" => "0"],
            ["name" => "栏目创建", "field"=>"column.create", "belong_to"=>"50", "acme" => "0"],
            ["name" => "栏目修改状态", "field"=>"column.edit_state", "belong_to"=>"50", "acme" => "0"],
            ["name" => "栏目显示", "field"=>"column.show", "belong_to"=>"50", "acme" => "0"],
            ["name" => "栏目修改（执行）", "field"=>"column.update", "belong_to"=>"50", "acme" => "0"],
            ["name" => "栏目删除", "field"=>"column.destroy", "belong_to"=>"50", "acme" => "0"],
            ["name" => "栏目修改", "field"=>"column.edit", "belong_to"=>"50", "acme" => "0"],

            //会员管理
            ["name" => "会员管理", "field"=>"user", "belong_to"=>"0", "acme" => "1"],
            ["name" => "会员列表", "field"=>"user.index", "belong_to"=>"59", "acme" => "0"],
            ["name" => "会员创建（执行）", "field"=>"user.store", "belong_to"=>"59", "acme" => "0"],
            ["name" => "会员创建", "field"=>"user.create", "belong_to"=>"59", "acme" => "0"],
            ["name" => "会员修改状态", "field"=>"user.edit_state", "belong_to"=>"59", "acme" => "0"],
            ["name" => "会员显示", "field"=>"user.show", "belong_to"=>"59", "acme" => "0"],
            ["name" => "会员修改（执行）", "field"=>"user.update", "belong_to"=>"59", "acme" => "0"],
            ["name" => "会员删除", "field"=>"user.destroy", "belong_to"=>"59", "acme" => "0"],
            ["name" => "会员修改", "field"=>"user.edit", "belong_to"=>"59", "acme" => "0"],
        ]);
    }
}
