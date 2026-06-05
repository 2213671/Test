package com.example.pos_hcsdl.dto;

import lombok.Data;

import java.time.LocalDateTime;

@Data
public class CurrentShift {
    private String id;
    private String openerId;
    private String closerId;
    private LocalDateTime openAt;
    private LocalDateTime closeAt;
}
