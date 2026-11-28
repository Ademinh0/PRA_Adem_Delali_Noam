<?php 
namespace App\Models;

class Reservation{
    private int $res_num;
    private string $res_date;
    private string $end_date;
    private string $start_date;


    /**
     * Get the value of res_num
     */ 
    public function getRes_num()
    {
        return $this->res_num;
    }

    /**
     * Set the value of res_num
     *
     * @return  self
     */ 
    public function setRes_num($res_num)
    {
        $this->res_num = $res_num;

        return $this;
    }

    /**
     * Get the value of end_date
     */ 
    public function getEnd_date()
    {
        return $this->end_date;
    }

    /**
     * Set the value of end_date
     *
     * @return  self
     */ 
    public function setEnd_date($end_date)
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * Get the value of res_date
     */ 
    public function getRes_date()
    {
        return $this->res_date;
    }

    /**
     * Set the value of res_date
     *
     * @return  self
     */ 
    public function setRes_date($res_date)
    {
        $this->res_date = $res_date;

        return $this;
    }

    /**
     * Get the value of start_date
     */ 
    public function getStart_date()
    {
        return $this->start_date;
    }

    /**
     * Set the value of start_date
     *
     * @return  self
     */ 
    public function setStart_date($start_date)
    {
        $this->start_date = $start_date;

        return $this;
    }
}