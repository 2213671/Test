package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.math.BigDecimal;
import java.time.LocalDateTime;
import java.time.LocalTime;
import java.util.List;

@Data
public class PromotionResponse {
    private String id;
    private String name;
    private String status;
    private BigDecimal value;
    private String type;
    private String applyType;
    private LocalDateTime startDate;
    private LocalDateTime endDate;
    private LocalTime startHour;
    private LocalTime endHour;
    private String restaurantId;
    private List<String> menus;
}
