package com.example.pos_hcsdl.controller;

import com.example.pos_hcsdl.dto.ProductRequest;
import com.example.pos_hcsdl.dto.ProductResponse;
import com.example.pos_hcsdl.service.ProductService;
import io.swagger.v3.oas.annotations.tags.Tag;
import jakarta.validation.Valid;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@Tag(name = "7. Product Management")
@RestController
@RequestMapping("/product")
public class ProductController {

    @Autowired
    private ProductService productService;

    @PostMapping("/create-product")
    public ProductResponse createProduct(
            @RequestBody @Valid ProductRequest productRequest,
            @RequestHeader(name = "X-Restaurant-Id") String restaurantId
    ) {
        return productService.createProduct(productRequest, restaurantId);
    }

    @GetMapping("/restaurant/{id}")
    public List<ProductResponse> getProductsByRestaurant(@PathVariable String id) {
        return productService.getProductByRestaurant(id);
    }

    @GetMapping("/menu/{id}")
    public List<ProductResponse> getProductsByMenu(@PathVariable String id) {
        return productService.getProductByMenu(id);
    }
}
