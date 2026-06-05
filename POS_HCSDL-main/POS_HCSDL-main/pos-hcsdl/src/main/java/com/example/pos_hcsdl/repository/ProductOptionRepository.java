package com.example.pos_hcsdl.repository;

import com.example.pos_hcsdl.entity.Product;
import com.example.pos_hcsdl.entity.ProductOption;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface ProductOptionRepository extends JpaRepository<ProductOption, String> {
    List<ProductOption> findAllByProduct(Product product);
}
