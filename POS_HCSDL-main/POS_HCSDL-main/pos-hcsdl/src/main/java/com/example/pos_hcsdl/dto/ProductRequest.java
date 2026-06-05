package com.example.pos_hcsdl.dto;

import jakarta.validation.constraints.NotNull;
import lombok.Data;

import java.math.BigDecimal;
import java.util.ArrayList;
import java.util.List;

@Data
public class ProductRequest {
    @NotNull
    private String name;
    private String description;
    private String tag;
    private String imageUrl;
    @NotNull
    private BigDecimal price;
    @NotNull
    private String menuId;
    private List<String> options = new ArrayList<>();
    private List<String> toppings = new ArrayList<>();
}

