SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, 
  FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `cake_blog` 
  DEFAULT CHARACTER SET latin1;
USE `cake_blog`;

-- -----------------------------------------------------
-- Table `cake_blog`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cake_blog`.`users` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(50) NULL DEFAULT NULL ,
  `password` VARCHAR(50) NULL DEFAULT NULL ,
  `role` VARCHAR(20) NULL DEFAULT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `cake_blog`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cake_blog`.`categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `category` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cake_blog`.`posts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cake_blog`.`posts` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `category_id` INT UNSIGNED NOT NULL ,
  `user_id` INT(10) UNSIGNED NOT NULL ,
  `title` VARCHAR(50) NULL DEFAULT NULL ,
  `body` TEXT NULL DEFAULT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_posts_users` (`user_id` ASC) ,
  INDEX `fk_posts_categories1` (`category_id` ASC) ,
  CONSTRAINT `fk_posts_users`
    FOREIGN KEY (`user_id` )
    REFERENCES `cake_blog`.`users` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_posts_categories1`
    FOREIGN KEY (`category_id` )
    REFERENCES `cake_blog`.`categories` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `cake_blog`.`tags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cake_blog`.`tags` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `tag` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cake_blog`.`posts_tags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cake_blog`.`posts_tags` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `post_id` INT(10) UNSIGNED NOT NULL ,
  `tag_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`),
  INDEX `fk_posts_has_tags_tags1` (`tag_id` ASC) ,
  INDEX `fk_posts_has_tags_posts1` (`post_id` ASC) ,
  CONSTRAINT `fk_posts_has_tags_posts1`
    FOREIGN KEY (`post_id` )
    REFERENCES `cake_blog`.`posts` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_posts_has_tags_tags1`
    FOREIGN KEY (`tag_id` )
    REFERENCES `cake_blog`.`tags` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `cake_blog`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cake_blog`.`comments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `comment` TEXT NULL ,
  `user_id` INT(10) UNSIGNED NOT NULL ,
  `post_id` INT(10) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_comments_users1` (`user_id` ASC) ,
  INDEX `fk_comments_posts1` (`post_id` ASC) ,
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `cake_blog`.`users` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT,
  CONSTRAINT `fk_comments_posts1`
    FOREIGN KEY (`post_id` )
    REFERENCES `cake_blog`.`posts` (`id` )
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

CREATE SCHEMA IF NOT EXISTS `cake_blog_test` 
  DEFAULT CHARACTER SET latin1;
