package com.example.pos_hcsdl.mapper;

import com.example.pos_hcsdl.dto.ProductRequest;
import com.example.pos_hcsdl.dto.ProductResponse;
import com.example.pos_hcsdl.entity.Product;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;

import java.util.List;

@Mapper(componentModel = "spring")
public interface ProductMapper {

    @Mapping(target = "restaurantId", source = "restaurant.id")
    @Mapping(target = "menuId", source = "menu.id")
    ProductResponse getProductResponse(Product product);

    Product getProduct(ProductRequest productRequest);


    List<ProductResponse> getProductResponseList(List<Product> products);
}
