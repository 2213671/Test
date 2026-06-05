package com.example.pos_hcsdl.repository;

import com.example.pos_hcsdl.entity.Product;
import com.example.pos_hcsdl.entity.ProductTopping;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface ProductToppingRepository extends JpaRepository<ProductTopping, String> {
    List<ProductTopping> findAllByProduct(Product product);
}
