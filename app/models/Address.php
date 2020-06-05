<?php
class Address
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAddresses()
    {
        $this->db->query('SELECT * FROM address');

        $results = $this->db->resultSet();

        return $results;
    }

    public function addAddress($data)
    {
        $this->db->query('INSERT INTO address
                          (street_number, street_name, suburb, city, region, postcode) 
                          VALUES
                          (:street_number, :street_name, :suburb, :city, :region, :postcode)');
        // Bind values
        $this->db->bind(':street_number', $data['street_number']);
        $this->db->bind(':street_name', $data['street_name']);
        $this->db->bind(':suburb', $data['suburb']);
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':region', $data['region']);
        $this->db->bind(':postcode', $data['postcode']);

        // Execute
        if ($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateAddress($data)
    {
        $this->db->query('UPDATE address SET 
                          street_number = :street_number, 
                          street_name = :street_name, 
                          suburb = :suburb, 
                          city = :city, 
                          region = :region, 
                          postcode = :postcode 
                          WHERE id = :id');
                          
        // Bind values
        $this->db->bind(':street_number', $data['street_number']);
        $this->db->bind(':street_name', $data['street_name']);
        $this->db->bind(':suburb', $data['suburb']);
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':region', $data['region']);
        $this->db->bind(':postcode' , $data['postcode']);

        // Execute
        if ($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function deleteAddress($id)
    {
        $this->db->query('DELETE FROM address WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}