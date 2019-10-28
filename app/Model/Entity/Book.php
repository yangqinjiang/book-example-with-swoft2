<?php declare(strict_types=1);
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://swoft.org/docs
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;

/**
 *
 * Class Book
 *
 * @since 2.0
 *
 * @Entity(table="book")
 */
class Book extends Model
{
    /**
     * @Id()
     *
     * @Column()
     *
     * @var int|null
     */
    private $id;

    /**
     * @Column()
     *
     * @var string
     */
    private $title;
    /**
     * @Column()
     *
     * @var string
     */
    private $author;
    /**
     * @Column()
     *
     * @var int
     */
    private $pages;
    /**
     * @Column()
     *
     * @var string
     */
    private $publiser;
    /**
     * @Column(name="publis_time")
     *
     * @var string
     */
    private $publisTime;
      

    /**
     * @param int|null $id
     *
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $title
     *
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    /**
     * @param string $author
     *
     * @return void
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }
    /**
     * @param string $publiser
     *
     * @return void
     */
    public function setPubliser(string $publiser): void
    {
        $this->publiser = $publiser;
    }
    /**
     * @param string $publis_time
     *
     * @return void
     */
    public function setPublisTime(string $publis_time): void
    {
        $this->publisTime = $publis_time;
    }
    /**
     * @param int $pages
     *
     * @return void
     */
    public function setPages(int $pages): void
    {
        $this->pages = $pages;
    }

     
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }
    /**
     * @return string
     */
    public function getPubliser(): string
    {
        return $this->publiser;
    }
 
    /**
     * @return string
     */
    public function getPublisTime(): string
    {
        return $this->publisTime;
    }
    /**
     * @return int
     */
    public function getPages(): int
    {
        return $this->pages;
    }

}
