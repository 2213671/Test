package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.math.BigDecimal;
import java.util.ArrayList;
import java.util.List;

@Data
public class ProductResponse {
    private String id;
    private String name;
    private String description;
    private String tag;
    private String imageUrl;
    private BigDecimal price;
    private String menuId;
    private String restaurantId;
    private List<OptionResponse> options = new ArrayList<>();
    private List<ToppingResponse> toppings = new ArrayList<>();
}
