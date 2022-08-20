<?php 

class Properties {
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function saveData($data){
        $this->db->query('INSERT INTO properties (data) VALUES (:data)');
        $this->db->bind(':data', $data);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getData(){
        $this->db->query('SELECT 
                            p.id as pId,
                            p.county as country,
                            p.town as town,
                            p.image_thumbnail as thumbnail,
                            p.price as price,
                            p.num_bedrooms as num_bedrooms,
                            p.type as type,
                            pt.title as title
                        FROM 
                            properties p
                        LEFT JOIN 
                            property_type pt
                        ON 
                            p.property_type_id = pt.id
                        ');
        $result = $this->db->resultSet();

        return $result;
    }

    public function getPropertyType($propertyTitle){
        $this->db->query('SELECT * FROM property_type WHERE title = :title');
        $this->db->bind(':title', $propertyTitle);

        $row = $this->db->single();

        return $row;
    }

    public function savePropertyTpe($data){
        $query = $this->db->query('INSERT INTO property_type (title,description,created_at,updated_at) VALUES (:title,:description,:created_at,:updated_at)');
        $this->db->bind(':title', $data->title);
        $this->db->bind(':description', $data->description);
        $this->db->bind(':created_at', $data->created_at);
        $this->db->bind(':updated_at', $data->updated_at);

        if($this->db->execute()){
            return $this->db->lastInsertId();
        }else{
            return false;
        }
    }

    public function saveProperty($data, $property_type_id){
        $this->db->query('INSERT INTO properties (property_type_id,
                                                  county,
                                                  country,
                                                  town,
                                                  description,
                                                  address,
                                                  image_full,
                                                  image_thumbnail,
                                                  latitude,
                                                  longitude,
                                                  num_bedrooms,
                                                  num_bathrooms,
                                                  price,
                                                  type,
                                                  created_at,
                                                  updated_at) 
                                                  
                                                  VALUES 
                                                  
                                                  (:property_type_id,
                                                  :county,
                                                  :country,
                                                  :town,
                                                  :description,
                                                  :address,
                                                  :image_full,
                                                  :image_thumbnail,
                                                  :latitude,
                                                  :longitude,
                                                  :num_bedrooms,
                                                  :num_bathrooms,
                                                  :price,
                                                  :type,
                                                  :created_at,
                                                  :updated_at)'
                                                  );
        $this->db->bind(':property_type_id', $property_type_id);
        $this->db->bind(':county', $data->county);
        $this->db->bind(':country', $data->country);
        $this->db->bind(':town', $data->town);
        $this->db->bind(':description', $data->description);
        $this->db->bind(':address', $data->address);
        $this->db->bind(':image_full', $data->image_full);
        $this->db->bind(':image_thumbnail', $data->image_thumbnail);
        $this->db->bind(':latitude', $data->latitude);
        $this->db->bind(':longitude', $data->longitude);
        $this->db->bind(':num_bedrooms', $data->num_bedrooms);
        $this->db->bind(':num_bathrooms', $data->num_bathrooms);
        $this->db->bind(':price', $data->price);
        $this->db->bind(':type', $data->type);
        $this->db->bind(':created_at', $data->created_at);
        $this->db->bind(':updated_at', $data->updated_at);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

}
