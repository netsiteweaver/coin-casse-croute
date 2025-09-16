-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema cassecroute1
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema cassecroute1
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cassecroute1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `cassecroute1` ;

-- -----------------------------------------------------
-- Table `cassecroute1`.`addons`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cassecroute1`.`addons` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(40) CHARACTER SET 'utf8mb4' NOT NULL,
  `stockref` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `name` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `cost_price` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `selling_price` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `photo` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `created_by` INT NULL DEFAULT NULL,
  `created_date` DATETIME NULL DEFAULT NULL,
  `display_order` INT NOT NULL,
  `status` TINYINT NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `cassecroute1`.`product_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cassecroute1`.`product_categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(40) CHARACTER SET 'utf8mb4' NOT NULL,
  `name` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `created_by` INT NULL DEFAULT NULL,
  `created_date` DATETIME NULL DEFAULT NULL,
  `status` TINYINT NOT NULL DEFAULT '1',
  `photo` TEXT CHARACTER SET 'utf8mb4' NULL DEFAULT NULL,
  `display_order` INT NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 13
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `cassecroute1`.`addons_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cassecroute1`.`addons_categories` (
  `addon_id` INT NOT NULL,
  `product_category_id` INT NOT NULL,
  PRIMARY KEY (`addon_id`, `product_category_id`),
  INDEX `fk_addons_categories_addons_idx` (`addon_id` ASC) VISIBLE,
  INDEX `fk_addons_categories_products_idx` (`product_category_id` ASC) VISIBLE,
  CONSTRAINT `fk_addons_categories_products`
    FOREIGN KEY (`product_category_id`)
    REFERENCES `cassecroute1`.`product_categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_addons_categories_addons`
    FOREIGN KEY (`addon_id`)
    REFERENCES `cassecroute1`.`addons` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `cassecroute1`.`departments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cassecroute1`.`departments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(40) NOT NULL,
  `name` VARCHAR(50) NOT NULL,
  `address` VARCHAR(100) NULL DEFAULT NULL,
  `phone` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `status` TINYINT NOT NULL DEFAULT '1',
  `created_by` INT NULL DEFAULT NULL,
  `created_date` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `cassecroute1`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cassecroute1`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(70) NOT NULL,
  `username` VARCHAR(30) NOT NULL,
  `password` VARCHAR(32) NOT NULL,
  `user_level` ENUM('Normal', 'Admin', 'Root') NULL DEFAULT 'Normal',
  `status` INT NOT NULL DEFAULT '1' COMMENT '1-Active,2-Inactive,0-deleted',
  `last_login` DATETIME NULL DEFAULT NULL,
  `ip` VARCHAR(15) NULL DEFAULT NULL,
  `name` VARCHAR(30) NULL DEFAULT NULL,
  `photo` VARCHAR(50) NULL DEFAULT NULL,
  `created_by` INT NOT NULL,
  `created` DATETIME NULL DEFAULT NULL,
  `job_title` VARCHAR(30) NULL DEFAULT NULL,
  `email` VARCHAR(50) NULL DEFAULT NULL,
  `force_update` INT NOT NULL DEFAULT '0',
  `department_id` INT NULL DEFAULT NULL,
  `is_sales` INT NOT NULL DEFAULT '0',
  `is_delivery` INT NOT NULL DEFAULT '0',
  `is_storekeeper` INT NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX `fk_user_dept` (`department_id` ASC) VISIBLE,
  INDEX `fk_user_user` (`created_by` ASC) VISIBLE,
  CONSTRAINT `fk_user_dept`
    FOREIGN KEY (`department_id`)
    REFERENCES `cassecroute1`.`departments` (`id`),
  CONSTRAINT `fk_user_user`
    FOREIGN KEY (`created_by`)
    REFERENCES `cassecroute1`.`users` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `cassecroute1`.`customers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cassecroute1`.`customers` (
  `customer_id` INT NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(40) CHARACTER SET 'utf8mb3' NOT NULL,
  `customer_code` VARCHAR(30) CHARACTER SET 'utf8mb3' NOT NULL,
  `title` ENUM('Mr', 'Mrs', 'Miss', 'Dr') CHARACTER SET 'utf8mb3' NOT NULL DEFAULT 'Mr',
  `first_name` VARCHAR(50) CHARACTER SET 'utf8mb3' NOT NULL,
  `last_name` VARCHAR(50) CHARACTER SET 'utf8mb3' NOT NULL,
  `address` VARCHAR(100) NULL DEFAULT NULL,
  `city` VARCHAR(100) NULL DEFAULT NULL,
  `phone_number1` VARCHAR(50) CHARACTER SET 'utf8mb3' NOT NULL,
  `phone_number2` VARCHAR(50) CHARACTER SET 'utf8mb3' NULL DEFAULT NULL,
  `email` VARCHAR(50) CHARACTER SET 'utf8mb3' NULL DEFAULT NULL,
  `nic` VARCHAR(14) NULL DEFAULT NULL,
  `dob` VARCHAR(10) CHARACTER SET 'utf8mb3' NOT NULL,
  `remarks` TEXT CHARACTER SET 'utf8mb3' NULL DEFAULT NULL,
  `discount` FLOAT NOT NULL DEFAULT '0',
  `status` TINYINT NOT NULL DEFAULT '1',
  `created_by` INT NULL DEFAULT NULL,
  `created_date` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`customer_id`),
  UNIQUE INDEX `nic` (`nic` ASC) VISIBLE,
  INDEX `fk_customers_users1_idx` (`created_by` ASC) VISIBLE,
  CONSTRAINT `fk_customers_users1`
    FOREIGN KEY (`created_by`)
    REFERENCES `cassecroute1`.`users` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 67
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `cassecroute1`.`menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cassecroute1`.`menu` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` ENUM('menu', 'section', 'divider') NULL DEFAULT 'menu',
  `nom` VARCHAR(30) NULL DEFAULT NULL,
  `controller` VARCHAR(30) NULL DEFAULT NULL,
  `action` VARCHAR(30) NULL DEFAULT NULL,
  `params` VARCHAR(30) NULL DEFAULT NULL,
  `url` VARCHAR(50) NULL DEFAULT NULL,
  `class` VARCHAR(50) NULL DEFAULT NULL,
  `display_order` INT NULL DEFAULT '50',
  `parent_menu` INT NULL DEFAULT NULL,
  `visible` TINYINT(1) NULL DEFAULT '1',
  `Normal` INT NULL DEFAULT '0',
  `Admin` INT NULL DEFAULT '0',
  `Root` INT NULL DEFAULT '1',
  `module` INT NOT NULL,
  `status` TINYINT NOT NULL DEFAULT '1',
  `backoffice` TINYINT NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 615
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `cassecroute1`.`migrations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cassecroute1`.`migrations` (
  `version` BIGINT NOT NULL)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `cassecroute1`.`payment_modes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cassecroute1`.`payment_modes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(40) NOT NULL,
  `name` VARCHAR(50) NOT NULL,
  `status` TINYINT NOT NULL DEFAULT '1',
  `created_by` INT NULL DEFAULT NULL,
  `created_date` DATETIME NULL DEFAULT NULL,
  `attachment` INT NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `cassecroute1`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cassecroute1`.`orders` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(40) NOT NULL,
  `document_number` VARCHAR(20) CHARACTER SET 'utf8mb3' NOT NULL,
  `created_date` DATETIME NULL DEFAULT NULL,
  `created_by` INT NOT NULL,
  `order_date` DATETIME NOT NULL,
  `customer_id` INT NULL DEFAULT NULL,
  `amount` FLOAT NOT NULL,
  `payment_mode_id` INT NOT NULL DEFAULT '1',
  `discount` FLOAT NOT NULL,
  `department_id` INT NOT NULL DEFAULT '1',
  `status` TINYINT NOT NULL DEFAULT '1',
  `customer_details` JSON NULL DEFAULT NULL,
  `table_number` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_orders_users_idx` (`created_by` ASC) VISIBLE,
  INDEX `fk_order_dept` (`department_id` ASC) VISIBLE,
  INDEX `fk_orders_payment_modes_idx` (`payment_mode_id` ASC) VISIBLE,
  CONSTRAINT `fk_order_dept`
    FOREIGN KEY (`department_id`)
    REFERENCES `cassecroute1`.`departments` (`id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_orders_users`
    FOREIGN KEY (`created_by`)
    REFERENCES `cassecroute1`.`users` (`id`),
  CONSTRAINT `fk_orders_payment_modes`
    FOREIGN KEY (`payment_mode_id`)
    REFERENCES `cassecroute1`.`payment_modes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 188
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `cassecroute1`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cassecroute1`.`products` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `uuid` VARCHAR(40) CHARACTER SET 'utf8mb4' NOT NULL,
  `stockref` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `name` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `description` TEXT CHARACTER SET 'utf8mb4' NULL DEFAULT NULL,
  `cost_price` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `selling_price` VARCHAR(50) CHARACTER SET 'utf8mb4' NOT NULL,
  `photo` VARCHAR(50) NULL DEFAULT NULL,
  `created_by` INT NULL DEFAULT NULL,
  `created_date` DATETIME NULL DEFAULT NULL,
  `status` TINYINT NOT NULL DEFAULT '1',
  `category_id` INT NULL DEFAULT NULL,
  `display_order` INT NOT NULL DEFAULT '1',
  `type` ENUM('product', 'addon') NOT NULL DEFAULT 'product',
  `vat` ENUM('0', '15') NOT NULL DEFAULT '15',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `stockref_idx` (`stockref` ASC) VISIBLE,
  INDEX `fk_product_users_idx` (`created_by` ASC) VISIBLE,
  INDEX `fk_product_category` (`category_id` ASC) VISIBLE,
  CONSTRAINT `fk_product_category`
    FOREIGN KEY (`category_id`)
    REFERENCES `cassecroute1`.`product_categories` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 22
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `cassecroute1`.`order_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cassecroute1`.`order_details` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `order_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` FLOAT NOT NULL,
  `price` FLOAT NOT NULL,
  `vat` ENUM('0', '15') NOT NULL DEFAULT '15',
  PRIMARY KEY (`id`),
  INDEX `fk_order_id` (`order_id` ASC) VISIBLE,
  INDEX `fk_order_product` (`product_id` ASC) VISIBLE,
  CONSTRAINT `fk_order_id`
    FOREIGN KEY (`order_id`)
    REFERENCES `cassecroute1`.`orders` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_order_product`
    FOREIGN KEY (`product_id`)
    REFERENCES `cassecroute1`.`products` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 136
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `cassecroute1`.`permissions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cassecroute1`.`permissions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NULL DEFAULT NULL,
  `profile_id` INT NULL DEFAULT NULL,
  `menu_id` INT NULL DEFAULT NULL,
  `create` INT NULL DEFAULT NULL,
  `read` INT NULL DEFAULT NULL,
  `update` INT NULL DEFAULT NULL,
  `delete` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_permissions_menu1_idx` (`menu_id` ASC) VISIBLE,
  INDEX `fk_permissions_users1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_permissions_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `cassecroute1`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_permissions_menu`
    FOREIGN KEY (`menu_id`)
    REFERENCES `cassecroute1`.`menu` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 881
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
