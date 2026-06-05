package com.example.pos_hcsdl.dto;

import com.example.pos_hcsdl.entity.OrderItem;
import jakarta.persistence.Column;
import lombok.AllArgsConstructor;
import lombok.Data;

import java.math.BigDecimal;
import java.util.ArrayList;
import java.util.List;

@Data
public class OrderItemDTO {
    private String id;
    @Column(name = "item_id")
    private String itemId;
    private BigDecimal price;
    private Long quantity;
    private String name;
    @Column(name = "item_type")
    private String itemType;
    @Column(name = "image_url")
    private String imageUrl;
    @Column(name = "menu_id")
    private String menuId;
    @Column(name = "discount_value")
    private BigDecimal discountValue;
    @Column(name = "discounted_price")
    private BigDecimal discountedPrice;
    private List<OrderSubItemResponse> subItems =  new ArrayList<>();

    public OrderItemDTO(String id, String itemId, BigDecimal price, Long quantity, String name, String itemType, String imageUrl, String menuId, BigDecimal discountValue, BigDecimal discountedPrice) {
        this.id = id;
        this.itemId = itemId;
        this.price = price;
        this.quantity = quantity;
        this.name = name;
        this.itemType = itemType;
        this.imageUrl = imageUrl;
        this.menuId = menuId;
        this.discountValue = discountValue;
        this.discountedPrice = discountedPrice;
    }
}
